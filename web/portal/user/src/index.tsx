import { createRoot } from 'react-dom/client';
import {
  ThemeProvider,
  createTheme,
  StyledEngineProvider,
} from '@mui/material';
import * as locales from '@mui/material/locale';
import reportWebVitals from './reportWebVitals';
import store from 'store';
import i18n from './i18n';
import './index.css';
import App from './App';
import { StoreProvider } from 'easy-peasy';

const currentLanguage =
  i18n.language.substring(0, 2) === 'es' ? 'esES' : 'enUS';

const theme = createTheme(
  {
    palette: {
      primary: {
        main: '#bf360c',
      },
      secondary: {
        main: '#2d333b',
      },
    },
  },
  locales[currentLanguage]
);

const container = document.getElementById('root');
const root = createRoot(container as any);
root.render(
  <StyledEngineProvider injectFirst>
    <ThemeProvider theme={theme}>
      <StoreProvider store={store}>
        <App />
      </StoreProvider>
    </ThemeProvider>
  </StyledEngineProvider>
);

// If you want to start measuring performance in your app, pass a function
// to log results (for example: reportWebVitals(console.log))
// or send to an analytics endpoint. Learn more: https://bit.ly/CRA-vitals
reportWebVitals();
