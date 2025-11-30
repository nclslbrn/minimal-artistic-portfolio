
import { Masonry } from "grid-rows-masonry";

const nftCollection = async () => {
  if (!document.body.classList.contains('page-template-collection')) return

	let numRequest = 0, isLoading = false

	const tezCollectorAdress = 'tz1TUdWnCG8t5ntQN9NW6EocrntiDLubeGpD',
	tzktApiUrl = 'https://api.tzkt.io/v1/tokens',
	objktApiUrl = 'https://data.objkt.com/v3/graphql/',
	ipfsGateway = 'https://ipfs.io/ipfs/',
	onchfsGateway = 'https://onchfs.fxhash2.xyz/',
	tokenPerRequest = 10,
	tokenGridElem = document.querySelector("main.site-main article .entry-content > .token-grid"),
	loadMoreButton = document.getElementById("load-more-tokens"),
	ipfsLink = (uri) => uri.replace('ipfs://', ipfsGateway),
	onchfsLink = (uri) => uri.replace('onchfs://', onchfsGateway),
	requestTezosTokenFromTezAdress = async () => {
		isLoading = true
		const res = await fetch(
			`${tzktApiUrl}/balances?account=${tezCollectorAdress}&balance.ne=0&token.metadata.displayUri.null=false&offset=${numRequest*tokenPerRequest}&limit=${tokenPerRequest}&select=id,balance,token.tokenId as tokenId,token.contract as contract,token.metadata.name as name,token.metadata.displayUri as displayUri,token.metadata.artifactUri as artifactUri`,
		);
		const tezAdressTokenBalance = await res.json()

		await Promise.all(tezAdressTokenBalance.map(async (x) => {
			const tokenRes = await fetch(`${tzktApiUrl}/?contract=${x.contract.address}&${x.tokenId ? 'tokenId=' + x.tokenId : ''}`)
			const tokenMeta = await tokenRes.json()

			const accountRes = await fetch(
				objktApiUrl, {
					method: "post",
					headers: {
						'Content-type': 'application/json'
					},
					body: JSON.stringify({
						operationName: "GalleryCardGetGallery",
						query: `query GalleryCardGetGallery($address: String!, $tokenId: String!) {
							gallery(
								where: {tokens: {fa_contract: {_eq: $address}, token_id: {_eq: $tokenId}}, registry: {type: {_eq: "auto"}}}
							) {
								...GalleryCardGallery  __typename  }}
								fragment GalleryCardGallery on gallery { slug logo name volume_24h gallery_id volume_total floor_price owners items pk registry
								{  name type __typename  }
								curators { curator { address alias logo __typename } __typename }
								tokens(limit: 1) { fa_contract  __typename  }  __typename\n}`,
						variables: { address: x.contract.address, tokenId: x.tokenId }
					})
				}
			)
			const accountMeta = await accountRes.json()

			return {
				tokenId: x.tokenId || 0,
				contract: x.contract || {},
				artistName: accountMeta.data.gallery[0].curators[0].curator.alias
					? accountMeta.data.gallery[0].curators[0].curator.alias
					: accountMeta.data.gallery[0].curators[0].curator.address,

				artistAdress: accountMeta.data.gallery[0].curators[0].curator.address,
				name: tokenMeta[0].metadata ? tokenMeta[0].metadata.name : '',
				displayUri: ipfsLink(x.displayUri),
				artifactUri: x.artifactUri.includes('ipfs://') ? ipfsLink(x.artifactUri) : onchfsLink(x.artifactUri)
			}
		})).then((tokens) => {
				tokens
				.filter((item) => item.name !== '[WAITING TO BE SIGNED]')
				.map(item => tokenGridElem.appendChild(embedToken(item)))
				isLoading = false
				numRequest++
			})
    },
	embedToken = (token) => {
		const tokenBox = document.createElement('figure')
		const thumbnail = document.createElement('img')
		const description = document.createElement('figcaption')

		thumbnail.src = ipfsLink(token.displayUri)
		// thumbnail.loading = 'lazy'
		thumbnail.alt = `${token.name} by `

		description.innerHTML = `<a target="_blank" href="${token.artifactUri}">${token.name}</a>`
		description.innerHTML += ` by <a target="_blank" href="https://objkt.com/users/${token.artistAdress}">${token.artistName}</a>`

		tokenBox.appendChild(thumbnail)
		tokenBox.appendChild(description)
		return tokenBox
	}
	new Masonry(tokenGridElem)

  	try {
    	await requestTezosTokenFromTezAdress();
		loadMoreButton.addEventListener('click', async () => {
			requestTezosTokenFromTezAdress()
		})
  	} catch (e) {
    	console.warn("error", e);
  	}

	const observer = new IntersectionObserver(async (entries) => {
		if (entries[0].isIntersecting && !isLoading) {
			try {
				requestTezosTokenFromTezAdress()
			} catch (e) {
				console.log(e.message);
			}
		}
	}, { threshold: 1.0 });
	observer.observe(loadMoreButton)
};

export { nftCollection };
