import type { Config } from 'tailwindcss'
import colors from 'tailwindcss/colors'

export default <Partial<Config>>{
  theme: {
    extend: {
      colors: {
        primary: colors.green,
        dark: "#1D1D1D",
        beige: "#FAF0E6",
        "gray-1": "#7C7C8D",
        "gray-2": "#404040",
        "red-1": "#9C4B4B",
        "white-1": "#FAF0E6",
      },
      backgroundImage: {
        'dark-gradient': 'linear-gradient(90deg, rgba(0, 0, 0, 0.5) 0%, rgba(0, 0, 0, 0) 100%)',
        'text-gradient': 'linear-gradient(180deg, rgba(28, 28, 28, 0) 0%, #1C1C1C 77.08%);'
      },
    }
  }
}
