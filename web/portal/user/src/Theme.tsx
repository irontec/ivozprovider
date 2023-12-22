import {
  createTheme,
  StyledEngineProvider,
  ThemeProvider,
} from '@mui/material';
import * as locales from '@mui/material/locale';
import { useEffect, useState } from 'react';
import { useStoreActions } from 'store';

import i18n from './i18n';

interface ThemeProps {
  children: JSX.Element;
}

export default function Theme(props: ThemeProps): JSX.Element {
  const { children } = props;

  const [, setTimestamp] = useState(new Date().getTime());
  const themeActions = useStoreActions((actions) => actions.theme);
  const apiGet = useStoreActions((actions) => actions.api.get);

  const currentLanguage =
    i18n.language.substring(0, 2) === 'es' ? 'esES' : 'enUS';

  const computedStyle = getComputedStyle(document.documentElement);
  const colorPrimary = computedStyle.getPropertyValue('--color-primary').trim();
  const colorSecondary = computedStyle
    .getPropertyValue('--color-secondary')
    .trim();

  useEffect(() => {
    themeActions.setLogo('empty.svg');
    apiGet({
      path: `/my/theme`,
      params: {},
      successCallback: async (value) => {
        const response = value as {
          name: string;
          theme: string;
          logo: string;
          color: string;
        };

        setThemeColor(response.color);

        themeActions.setName(response.name);
        themeActions.setTheme(response.theme);
        themeActions.setLogo(response.logo as string);
      },
      handleErrors: false,
    })
      .catch((error) => {
        console.error('Unable to resolve my theme', error);
        themeActions.setLogo('logo.svg');
      })
      .finally(() => {
        setTimestamp(new Date().getTime());
      });
  }, [apiGet, themeActions]);

  const theme = createTheme({
    ...locales[currentLanguage],
    palette: {
      primary: {
        main: colorPrimary,
      },
      secondary: {
        main: colorSecondary,
      },
    },
    typography: {
      allVariants: {
        fontFamily: ['PublicSans', 'Roboto', 'Arial', 'sans-serif'].join(','),
      },
    },
  });

  return (
    <StyledEngineProvider injectFirst>
      <ThemeProvider theme={theme}>{children}</ThemeProvider>
    </StyledEngineProvider>
  );
}

function setThemeColor(hexColor: string) {
  const style = document?.querySelector(':root')?.style as
    | CSSStyleDeclaration
    | undefined;

  if (!style) {
    return;
  }

  style.setProperty('--color-primary', hexColor);

  const rgbColor = hexToRgb(hexColor);
  style.setProperty('--color-primary-rgb', rgbColor);

  const hsl = hexToHsl(hexColor);
  style.setProperty('--color-primary-tonal', hsl);
}

function hexToRgb(value: string): string {
  const hex = value.replace(/^#/, '');
  const num = parseInt(hex, 16);

  const red = (num >> 16) & 255;
  const green = (num >> 8) & 255;
  const blue = num & 255;

  return `rgb(${red}, ${green}, ${blue})`;
}

function hexToHsl(value: string) {
  const hex = value.replace(/^#/, '');

  const num = parseInt(hex, 16);

  const red = (num >> 16) & 255;
  const green = (num >> 8) & 255;
  const blue = num & 255;

  const r = red / 255;
  const g = green / 255;
  const b = blue / 255;

  const max = Math.max(r, g, b);
  const min = Math.min(r, g, b);

  let lightness = (max + min) / 2;

  let saturation = 0;
  if (max !== min) {
    saturation =
      lightness > 0.5
        ? (max - min) / (2 - max - min)
        : (max - min) / (max + min);
  }

  let hue = 0;
  if (max === r) {
    hue = (g - b) / (max - min);
  } else if (max === g) {
    hue = 2 + (b - r) / (max - min);
  } else {
    hue = 4 + (r - g) / (max - min);
  }

  if (isNaN(hue)) {
    hue = 0;
  }

  hue *= 60;
  if (hue < 0) {
    hue += 360;
  }

  hue = Math.round(hue);
  saturation = Math.round(saturation * 100);
  lightness = Math.max(Math.round(lightness * 100), 90);

  return `hsl(${hue}, ${saturation}%, ${lightness}%)`;
}
