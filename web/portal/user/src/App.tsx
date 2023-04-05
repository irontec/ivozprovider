import { LinearProgress, CssBaseline } from '@mui/material';
import AdapterDateFns from '@mui/lab/AdapterDateFns';
import LocalizationProvider from '@mui/lab/LocalizationProvider';
import { BrowserRouter } from 'react-router-dom';
import { StoreContainer } from '@irontec/ivoz-ui';
import { StyledAppApiLoading, StyledAppFlexDiv } from './App.styles';
import store, { useStoreActions, useStoreState } from 'store';
import AppRoutes from './router/AppRoutes';
import { useEffect } from 'react';

export default function App(): JSX.Element {
  StoreContainer.store = store;

  const apiSpecStore = useStoreActions((actions: any) => {
    return actions.spec;
  });
  const authStore = useStoreActions((actions: any) => actions.auth);
  const setLoginProps = useStoreActions(
    (actions: any) => actions.auth.setLoginProps
  );

  useEffect(() => {
    setLoginProps({
      path: '/user_login',
    });
    apiSpecStore.setSessionStoragePrefix('IP-user-');
    apiSpecStore.init();
    authStore.setSessionStoragePrefix('IP-user-');
    authStore.init();
  }, [apiSpecStore, authStore, setLoginProps]);

  const apiSpec = useStoreState((state) => state.spec.spec);
  const baseUrl = process.env.BASE_URL;

  if (!apiSpec || Object.keys(apiSpec).length === 0) {
    return (
      <StyledAppApiLoading>
        <LinearProgress />
        <br />
        Loading API definition...
      </StyledAppApiLoading>
    );
  }

  return (
    <LocalizationProvider dateAdapter={AdapterDateFns}>
      <CssBaseline />
      <StyledAppFlexDiv>
        <BrowserRouter basename={baseUrl}>
          <AppRoutes apiSpec={apiSpec} />
        </BrowserRouter>
      </StyledAppFlexDiv>
    </LocalizationProvider>
  );
}
