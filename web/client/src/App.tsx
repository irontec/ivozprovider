import { Grid, LinearProgress, CssBaseline } from '@mui/material';
import AdapterDateFns from '@mui/lab/AdapterDateFns';
import LocalizationProvider from '@mui/lab/LocalizationProvider';
import { BrowserRouter } from "react-router-dom";
import { Header, Footer } from 'lib/components';
import { StyledAppContent, StyledAppApiLoading, StyledAppBodyContainer, StyledContainer, StyledAppFlexDiv, StyledAppBarSpacer } from './App.styles';
import { useStoreActions, useStoreState } from 'store';
import { AppRoutesProps } from 'router/AppRoutes';

interface AppProps {
  children: React.FunctionComponent<AppRoutesProps>
}

export default function App(props: AppProps): JSX.Element {

  const apiSpecInitFn = useStoreActions((actions: any) => {
    return actions.spec.init;
  });
  const authInit = useStoreActions((actions: any) => actions.auth.init);

  apiSpecInitFn();
  authInit();

  const token = useStoreState((state) => state.auth.token);
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
          <Header loggedIn={!!token} />
          <StyledAppContent>
            <StyledAppBarSpacer />
            <StyledContainer>
              <Grid container spacing={3}>
                <Grid item xs={12}>
                  <StyledAppBodyContainer>
                    <props.children token={token as string} apiSpec={apiSpec} />
                  </StyledAppBodyContainer>
                </Grid>
                <Grid item xs={12}>
                  <Footer />
                </Grid>
              </Grid>
            </StyledContainer>
          </StyledAppContent>
        </BrowserRouter>
      </StyledAppFlexDiv>
    </LocalizationProvider>
  );
}