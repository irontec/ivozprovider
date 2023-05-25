import './index.css';

import {
  createTheme,
  StyledEngineProvider,
  ThemeProvider,
} from '@mui/material';
import * as locales from '@mui/material/locale';
import { StoreProvider } from 'easy-peasy';
import { createRoot } from 'react-dom/client';
import store from 'store';

import App from './App';
import i18n from './i18n';
import reportWebVitals from './reportWebVitals';

const currentLanguage =
  i18n.language.substring(0, 2) === 'es' ? 'esES' : 'enUS';

const computedStyle = getComputedStyle(document.documentElement);
const colorPrimary = computedStyle.getPropertyValue('--color-primary').trim();
const colorSecondary = computedStyle
  .getPropertyValue('--color-secondary')
  .trim();
const colorContrastText = computedStyle
  .getPropertyValue('--color-button')
  .trim();

const theme = createTheme({
  ...locales[currentLanguage],
  palette: {
    primary: {
      main: colorPrimary,
      contrastText: colorContrastText,
    },
    secondary: {
      main: colorSecondary,
      contrastText: colorContrastText,
    },
  },
  typography: {
    allVariants: {
      fontFamily: ['PublicSans', 'Roboto', 'Arial', 'sans-serif'].join(','),
    },
  },
});

const container = document.getElementById('root');
const root = createRoot(container as Element);

//@see https://github.com/ctrlplusb/easy-peasy/issues/741
type Props = StoreProvider['props'] & { children: React.ReactNode };
const StoreProviderOverride =
  StoreProvider as unknown as React.ComponentType<Props>;

root.render(
  <StyledEngineProvider injectFirst>
    <ThemeProvider theme={theme}>
      <StoreProviderOverride store={store}>
        <App />
      </StoreProviderOverride>
    </ThemeProvider>
  </StyledEngineProvider>
);

// If you want to start measuring performance in your app, pass a function
// to log results (for example: reportWebVitals(console.log))
// or send to an analytics endpoint. Learn more: https://bit.ly/CRA-vitals
reportWebVitals();
