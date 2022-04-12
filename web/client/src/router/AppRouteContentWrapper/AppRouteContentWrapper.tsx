import { Grid } from '@mui/material';
import { Header, Footer } from '@irontec/ivoz-ui/components/layout';
import {
  StyledAppContent,
  StyledAppBodyContainer,
  StyledContainer,
  StyledAppBarSpacer,
} from './AppRouteContentWrapper.styles';
import { RouteMap } from '@irontec/ivoz-ui/router/routeMapParser';

interface AppRouteContentProps {
  routeMap: RouteMap,
  loggedIn: boolean,
  children: JSX.Element
}

export default function AppRouteContentWrapper(props: AppRouteContentProps): JSX.Element {

  const { loggedIn, routeMap } = props;

  return (
    <>
      <Header loggedIn={loggedIn} routeMap={routeMap} />
      <StyledAppContent>
        <StyledAppBarSpacer />
        <StyledContainer>
          <Grid container spacing={3}>
            <Grid item xs={12}>
              <StyledAppBodyContainer>
                {props.children}
              </StyledAppBodyContainer>
            </Grid>
            <Grid item xs={12}>
              <Footer />
            </Grid>
          </Grid>
        </StyledContainer>
      </StyledAppContent>
    </>
  );
}