import { LinearProgress, CssBaseline } from '@mui/material';
import AdapterDateFns from '@mui/lab/AdapterDateFns';
import LocalizationProvider from '@mui/lab/LocalizationProvider';
import { BrowserRouter } from "react-router-dom";
import { StyledAppApiLoading, StyledAppFlexDiv } from './App.styles';
import { useStoreActions, useStoreState } from 'store';
import AppRoutes from './router/AppRoutes';
import { useEffect } from 'react';

export default function App(): JSX.Element {

  const apiSpecInitFn = useStoreActions((actions: any) => {
    return actions.spec.init;
  });
  const authInit = useStoreActions((actions: any) => actions.auth.init);
  const aboutMeInit = useStoreActions((actions: any) => actions.clientSession.aboutMe.init);
  const token = useStoreState((state) => state.auth.token);
  const aboutMe = useStoreState((state) => state.clientSession.aboutMe.profile);

  useEffect(
    () => {
      apiSpecInitFn();
      authInit();
      aboutMeInit();
    },
    [token, apiSpecInitFn, authInit, aboutMeInit]
  )

  const apiSpec = useStoreState((state) => state.spec.spec);
  const basename = process.env.PUBLIC_URL;

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
        <BrowserRouter basename={basename}>
          <AppRoutes token={token as string} aboutMe={aboutMe} apiSpec={apiSpec} />
        </BrowserRouter>
      </StyledAppFlexDiv>
    </LocalizationProvider>
  );
}