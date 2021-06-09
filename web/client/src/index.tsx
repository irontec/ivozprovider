import ReactDOM from 'react-dom';
import './index.css';
import App from './App';
import reportWebVitals from './reportWebVitals';
import { StoreProvider, createStore } from "easy-peasy";
import storeModel from './store';
import './i18n';

const store = createStore(storeModel);

ReactDOM.render(
  //<React.StrictMode>
      <StoreProvider store={store}>
        <App />
      </StoreProvider>
  //</React.StrictMode>
  ,
  document.getElementById('root')
);

// If you want to start measuring performance in your app, pass a function
// to log results (for example: reportWebVitals(console.log))
// or send to an analytics endpoint. Learn more: https://bit.ly/CRA-vitals
reportWebVitals();
