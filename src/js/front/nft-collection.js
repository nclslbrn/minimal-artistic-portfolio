
import { Masonry } from "grid-rows-masonry";

const nftCollection = async () => {
  if (!document.body.classList.contains('page-template-collection')) return

	let numRequest = 0, isLoading = false

	const tezCollectorAdress = 'tz1TUdWnCG8t5ntQN9NW6EocrntiDLubeGpD',
	tzktApiUrl = 'https://api.tzkt.io/v1/tokens',
	ipfsGateway = 'https://ipfs.io/ipfs/',
	tokenPerRequest = 10,
	tokenGridElem = document.querySelector("main.site-main article .entry-content > .token-grid"),
	loadMoreButton = document.getElementById("load-more-tokens"),
	ipfsLink = (uri) => uri.replace('ipfs://', ipfsGateway),
	requestTezosTokenFromTezAdress = async () => {
		isLoading = true
		const res = await fetch(
			`${tzktApiUrl}/balances?account=${tezCollectorAdress}&balance.ne=0&token.metadata.displayUri.null=false&offset=${numRequest*tokenPerRequest}&limit=${tokenPerRequest}&select=id,balance,token.tokenId as tokenId,token.contract as contract,token.metadata.name as name,token.metadata.displayUri as displayUri,token.metadata.artifactUri as artifactUri`,
		);
		const tezAdressTokenBalance = await res.json()

		await Promise.all(tezAdressTokenBalance.map(async (x) => {
			const tokenRes = await fetch(`https://api.tzkt.io/v1/tokens/?contract=${x.contract.address}&${x.tokenId ? 'tokenId=' + x.tokenId : ''}`)
			const tokenMeta = await tokenRes.json()
			return {
				tokenId: x.tokenId || 0,
				contract: x.contract || {},
				artistName: tokenMeta[0].firstMinter ? tokenMeta[0].firstMinter.alias : '',
				artistAdress: tokenMeta[0].firstMinter ? tokenMeta[0].firstMinter.address : '',
				name: tokenMeta[0].metadata ? tokenMeta[0].metadata.name : '',
				displayUri: ipfsLink(x.displayUri),
				artifactUri: ipfsLink(x.artifactUri)
			}
		})).then((tokens) => {
				tokens.map(item => tokenGridElem.appendChild(embedToken(item)))
				isLoading = false
				numRequest++
			})
    },
	embedToken = (token) => {
		const tokenBox = document.createElement('div')
		const thumbnail = document.createElement('img')
		thumbnail.src = ipfsLink(token.displayUri)
		thumbnail.alt = `${token.name} by `
		tokenBox.appendChild(thumbnail)
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
