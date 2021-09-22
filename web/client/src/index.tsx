import ReactDOM from 'react-dom';
import { ThemeProvider, createTheme, StyledEngineProvider } from '@mui/material';
import * as locales from '@mui/material/locale';
import App from './App';
import reportWebVitals from './reportWebVitals';
import { StoreProvider, createStore } from "easy-peasy";
import storeModel from './store';
import i18n from './i18n';
import './index.css';

const currentLanguage = i18n.language.substring(0, 2) === 'es'
  ? 'esES'
  : 'enUS';

const theme = createTheme({}, locales[currentLanguage]);
const store = createStore(storeModel);

ReactDOM.render(
  //<React.StrictMode>
  <StyledEngineProvider injectFirst>
    <ThemeProvider theme={theme}>
      <StoreProvider store={store}>
        <App />
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
