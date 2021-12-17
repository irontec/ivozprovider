import ReactDOM from 'react-dom';
import { ThemeProvider, createTheme, StyledEngineProvider } from '@mui/material';
import * as locales from '@mui/material/locale';
import reportWebVitals from './reportWebVitals';
import { StoreProvider } from "easy-peasy";
import store from 'store';
import i18n from './i18n';
import './index.css';
import App, { AppRoutesProps } from 'lib/App';
import AppRoutes from './AppRoutes';

const currentLanguage = i18n.language.substring(0, 2) === 'es'
  ? 'esES'
  : 'enUS';

const theme = createTheme(
  {
    palette: {
      primary: {
        main: '#4383cc',
      },
      secondary: {
        main: '#e53935',
      },
    },
  },
  locales[currentLanguage]
);

ReactDOM.render(
  //<React.StrictMode>
  <StyledEngineProvider injectFirst>
    <ThemeProvider theme={theme}>
      <StoreProvider store={store}>
        <App>
          {(props: AppRoutesProps) => {
            return (<AppRoutes {...props} />);
          }}
        </App>
      </StoreProvider>
    </ThemeProvider>
  </StyledEngineProvider>
  //</React.StrictMode>
  ,
  document.getElementById('root')
);

// If you want to start measuring performance in your app, pass a function
// to log results (for example: reportWebVitals(console.log))
// or send to an analytics endpoint. Learn more: https://bit.ly/CRA-vitals
reportWebVitals();
