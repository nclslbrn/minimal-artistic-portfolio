const nftCollection = async () => {
  // if (!document.body.classList.contains('page-template-collection')) return
  const tezCollectorAdress = 'tz1TUdWnCG8t5ntQN9NW6EocrntiDLubeGpD',
    ipfsGateway = 'https://ipfs.io/ipfs/',
    numRequest = 0,
    tokenPerRequest = 8,
    collection = [],
    ipfsLink = (uri) => uri.replace('ipfs://', ipfsGateway),
    requestTezosNft = async () => {
      const res = await fetch(
        `https://api.tzkt.io/v1/tokens/balances?account=${tezCollectorAdress}&balance.ne=0&token.metadata.displayUri.null=false&offset=${
          numRequest * tokenPerRequest
        }&limit=${tokenPerRequest}&select=id,balance,token.metadata.name as name,token.metadata.displayUri as displayUri,token.metadata.artifactUri as artifactUri`,
      );
      console.log(res);
      const items = (await res.json()).map((x) => ({
        ...x,
        displayUri: ipfsLink(x.displayUri),
        artifactUri: ipfsLink(x.artifactUri),
      }));
      collection.push(...items);
    };

  try {
    await requestTezosNft();
    const debugBox = document.createElement("pre");
    debugBox.innerText = JSON.stringify(collection);

    const parent = document.querySelector("main.site-main");
    parent.appendChild(debugBox);
  } catch (e) {
    console.warn("error", e);
  }
};

export { nftCollection };
