import { createRoot } from 'react-dom/client';
import {
  ThemeProvider,
  createTheme,
  StyledEngineProvider,
} from '@mui/material';
import * as locales from '@mui/material/locale';
import reportWebVitals from './reportWebVitals';
import { StoreProvider } from 'easy-peasy';
import store from 'store';
import i18n from './i18n';
import './index.css';
import App from './App';

const currentLanguage =
  i18n.language.substring(0, 2) === 'es' ? 'esES' : 'enUS';

const theme = createTheme(
  {
    palette: {
      primary: {
        main: '#0277bd',
      },
      secondary: {
        main: '#e53935',
      },
    },
  },
  locales[currentLanguage]
);

const container = document.getElementById('root');
const root = createRoot(container as any);

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
