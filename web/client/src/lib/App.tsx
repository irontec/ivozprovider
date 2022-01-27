import { Grid, LinearProgress, CssBaseline } from '@mui/material';
import AdapterDateFns from '@mui/lab/AdapterDateFns';
import LocalizationProvider from '@mui/lab/LocalizationProvider';
import { BrowserRouter } from "react-router-dom";
import { Header, Footer } from 'lib/components';
import { StyledAppContent, StyledAppBarSpacer, StyledAppApiLoading, StyledAppPaper, StyledContainer, StyledAppFlexDiv } from './App.styles';
import ParsedApiSpecInterface from './services/api/ParsedApiSpecInterface';
import { useStoreActions, useStoreState } from 'store';

export interface AppRoutesProps {
  token: string,
  apiSpec: ParsedApiSpecInterface
}

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

  const token = useStoreState((state: any) => state.auth.token);
  const apiSpec = useStoreState((state: any) => state.spec.spec);
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
                  <StyledAppPaper>
                    <props.children token={token} apiSpec={apiSpec} />
                  </StyledAppPaper>
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