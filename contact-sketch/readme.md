### Canvas / Svg as background of the contact page 

The index of this folder we be include as iframe on the contact page, in the #main element.

To build the sketch you can use some params with the snippet below 

```
let searchParams = new URLSearchParams(window.location.search);
const sketchProps = {
  w: searchParams.get('w'),
  h: searchParams.get('h'),
  background: '#' + searchParams.get('c1').replace(' ', ''),
  stroke: '#' + searchParams.get('c2').replace(' ', '')
}
```