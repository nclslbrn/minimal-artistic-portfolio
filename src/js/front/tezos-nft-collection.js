const tezCollectorAdress = 'tz1TUdWnCG8t5ntQN9NW6EocrntiDLubeGpD',
	ipfsGateway = 'https://ipfs.io/ipfs/',
	numRequest = 0,
	tokenPerRequest = 8,
	collection = [],
	ipfsLink = (uri) => uri.replace('ipfs://', ipfsGateway),
	request = async () => {
		const res = await fetch(`https://api.tzkt.io/v1/tokens/balances?account=${tezCollectorAdress}&balance.ne=0&token.metadata.displayUri.null=false&offset=${numRequest*tokenPerRequest}&limit=${tokenPerRequest}&select=id,balance,token.metadata.name as name,token.metadata.displayUri as displayUri,token.metadata.artifactUri as artifactUri`)
		const items = (await res.json()).map(x => ({
           	...x,
            displayUri: ipfsLink(x.displayUri),
            artifactUri: ipfsLink(x.artifactUri),
        }));
        collection.push(...items);
	}
