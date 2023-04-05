import { LinearProgress, CssBaseline } from '@mui/material';
import AdapterDateFns from '@mui/lab/AdapterDateFns';
import LocalizationProvider from '@mui/lab/LocalizationProvider';
import { BrowserRouter } from 'react-router-dom';
import { StyledAppApiLoading, StyledAppFlexDiv } from './App.styles';
import store, { useStoreActions, useStoreState } from 'store';
import AppRoutes from './router/AppRoutes';
import { useEffect } from 'react';
import { StoreContainer } from '@irontec/ivoz-ui';
import { useTranslation } from 'react-i18next';
import { languagesList } from './translations/languages';

export default function App(): JSX.Element {
  StoreContainer.store = store;
  const setLanguages = useStoreActions(
    (actions: any) => actions.i18n.setLanguages
  );
  const languages = setLanguages(languagesList);

  const apiSpecStore = useStoreActions((actions: any) => {
    return actions.spec;
  });
  const authStore = useStoreActions((actions: any) => actions.auth);

  const token = useStoreState((actions: any) => actions.auth.token);
  const aboutMeResetProfile = useStoreActions(
    (actions: any) => actions.clientSession.aboutMe.resetProfile
  );
  const aboutMeInit = useStoreActions(
    (actions: any) => actions.clientSession.aboutMe.init
  );

  useTranslation();

  useEffect(() => {
    apiSpecStore.setSessionStoragePrefix('IP-platform-');
    apiSpecStore.init();
    authStore.setSessionStoragePrefix('IP-platform-');
    authStore.init();
    aboutMeResetProfile();
    aboutMeInit();
  }, [apiSpecStore, authStore, token, aboutMeInit, aboutMeResetProfile]);

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
          <AppRoutes apiSpec={apiSpec} languages={languages.payload} />
        </BrowserRouter>
      </StyledAppFlexDiv>
    </LocalizationProvider>
  );
}
