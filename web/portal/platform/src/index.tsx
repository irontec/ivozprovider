import './index.css';

import { StoreProvider } from 'easy-peasy';
import { createRoot } from 'react-dom/client';
import store from 'store';

import App from './App';
import reportWebVitals from './reportWebVitals';
import Theme from './Theme';

const container = document.getElementById('root');
const root = createRoot(container as Element);

//@see https://github.com/ctrlplusb/easy-peasy/issues/741
type Props = StoreProvider['props'] & { children: React.ReactNode };
const StoreProviderOverride =
  StoreProvider as unknown as React.ComponentType<Props>;

root.render(
  <StoreProviderOverride store={store}>
    <Theme>
      <App />
    </Theme>
  </StoreProviderOverride>
);

// If you want to start measuring performance in your app, pass a function
// to log results (for example: reportWebVitals(console.log))
// or send to an analytics endpoint. Learn more: https://bit.ly/CRA-vitals
reportWebVitals();
