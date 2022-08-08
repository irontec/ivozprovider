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

  const apiSpecInitFn = useStoreActions((actions: any) => {
    return actions.spec.init;
  });
  const authInit = useStoreActions((actions: any) => actions.auth.init);
  const setLoginProps = useStoreActions(
    (actions: any) => actions.auth.setLoginProps
  );
  useEffect(() => {
    apiSpecInitFn();
    setLoginProps({
      path: '/user_login',
    });
    authInit();
  }, [apiSpecInitFn, authInit, setLoginProps]);

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
