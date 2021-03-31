import * as React from "react"
import Svg, { Defs, G, Path } from "react-native-svg"
/* SVGR has dropped some elements not supported by react-native-svg: filter, style */

function SvgComponent(props) {
  return (
    <Svg
      width={320.305}
      height={122.021}
      xmlns="http://www.w3.org/2000/svg"
      viewBox="89.847 13.989 320.305 122.021"
      style={{
        background: "#596886",
      }}
      preserveAspectRatio="xMidYMid"
      {...props}
    >
      <Defs></Defs>
      <G filter="url(#prefix__editing-hover)">
        <Path
          d="M136.881 113.262q3.27-.38 5.32-4.61 2.11-4.28 4.03-14.14l6.21-32.32h13.88l-6.2 32.32q-2.37 12.54-6.28 17.47-2.04 2.56-4.64 3.59-2.59 1.02-5.4 1.02-2.82 0-4.64-1.02-1.83-1.03-2.28-2.31zm44.8-7.55q-14.08 0-14.08-13.25 0-9.41 5.19-15.49 5.5-6.46 15.04-6.46 6.91 0 10.43 3.2 3.52 3.2 3.52 9.92 0 10.24-5.5 16.19-5.38 5.89-14.6 5.89zm1.67-27.84q-.77 1.73-1.38 4.32-.61 2.59-1.37 6.69-.77 4.09-.77 9.15 0 1.66.54 2.75.55 1.09 2.02 1.09t2.4-.7q.93-.71 1.63-2.37 1.28-2.95 2.3-8.42 1.03-5.47 1.12-7.84.1-2.37.1-4.13 0-1.76-.51-2.91-.51-1.15-1.95-1.15t-2.4.9q-.96.89-1.73 2.62zm37.57 23.04q-1.99 4.8-8.32 4.8-3.27 0-5.32-2.24-1.72-1.98-1.72-3.97 0-5.18 2.36-15.29l2.37-12.42 12.99-1.28-3.9 20.22q-1.09 4.74-1.09 6.4 0 3.65 2.63 3.78zm-9.48-38.02q0-2.49 2.08-3.84 2.08-1.34 5.09-1.34t4.83 1.34q1.83 1.35 1.83 3.84 0 2.5-2.02 3.78-2.01 1.28-5.02 1.28t-4.9-1.28q-1.89-1.28-1.89-3.78zm41.99 42.82q-7.75 0-7.75-6.02.07-1.66.58-4.48l1.15-5.88q1.73-8.32 1.73-10.18 0-3.71-2.18-3.71-3.64 0-5.56 9.53l-3.78 19.46-12.86 1.28 6.65-33.98 10.5-1.22-1.03 6.27q3.01-6.27 12.23-6.27 4.48 0 6.37 1.89 1.88 1.89 1.88 6.11 0 3.97-2.04 13.25-.96 4.16-.96 5.73 0 1.56.86 2.46.86.9 2.14 1.02-.64 2.18-2.84 3.46-2.21 1.28-5.09 1.28zm18.49-1.28h-7.36l11.59-42.24h13.37l2.95 24.13 11.9-24.13h11.2l1.15 31.62q.26 6.27 3.33 8.19-.7 1.28-2.75 2.49-2.05 1.22-4.77 1.22-2.72 0-4.32-.77t-2.49-2.05q-1.6-2.3-1.6-6.72v-19.77l-12.61 28.03h-7.94l-4.48-28.74-7.17 28.74zm78.21-9.86q1.22 1.54 1.22 4.04 0 3.45-2.56 5.28-2.56 1.82-6.59 1.82-2.31 0-5.83-.51-6.91-1.09-9.02-1.09-2.11 0-2.95.1-.83.09-2.17.22l7.87-42.24h27.58q0 3.9-1.88 5.95-1.89 2.05-5.6 2.05-3.72 0-7.49-1.73l-1.99 11.2h11.4q0 3.39-1.67 5.28-1.66 1.89-4.45 1.89-2.78 0-4.51-.64t-1.92-.83l-2.3 12.09q1.53.2 4.41.2 4.93 0 8.45-3.08z"
          fill="#ffd5af"
        />
      </G>
    </Svg>
  )
}

export default SvgComponent
