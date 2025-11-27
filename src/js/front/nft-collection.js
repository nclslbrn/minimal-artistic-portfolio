const nftCollection = async () => {
  if (!document.body.classList.contains('page-template-collection')) return

	let numRequest = 0

	const tezCollectorAdress = 'tz1TUdWnCG8t5ntQN9NW6EocrntiDLubeGpD',

    ipfsGateway = 'https://ipfs.io/ipfs/',

		tokenPerRequest = 10,

		parent = document.querySelector("main.site-main article .entry-content > .tokens"),

		loadMoreButton = document.getElementById("load-more-tokens"),

    ipfsLink = (uri) => uri.replace('ipfs://', ipfsGateway),

		requestTezosTokenFromTezAdress = async () => {

			// https://api.tzkt.io/v1/tokens/balances?account=${tezCollectorAdress}&balance.ne=0&token.metadata.displayUri.null=false&offset=0&limit=10&select=id,balance,token.metadata.name as name,token.metadata.displayUri as displayUri,token.metadata.artifactUri as artifactUri11
      const res = await fetch(
        `https://api.tzkt.io/v1/tokens/balances?account=${tezCollectorAdress}&balance.ne=0&token.metadata.displayUri.null=false&offset=${
          numRequest * tokenPerRequest
        }&limit=${tokenPerRequest}&select=id,balance,token.tokenId as tokenId,token.contract as contract,token.metadata.name as name,token.metadata.displayUri as displayUri,token.metadata.artifactUri as artifactUri`,
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
					tokens.map(item => parent.appendChild(embedToken(item)))
					numRequest++
			})
    },
		embedToken = (token) => {
			const parent = document.createElement('div')
			const thumbnail = document.createElement('img')
			thumbnail.src = ipfsLink(token.displayUri)
			thumbnail.alt = `${token.name} by `

			parent.appendChild(thumbnail)

			return parent
		}


  try {
    await requestTezosTokenFromTezAdress();
		loadMoreButton.addEventListener('click', async () => {
			requestTezosTokenFromTezAdress()
		})
  } catch (e) {
    console.warn("error", e);
  }
};

export { nftCollection };
