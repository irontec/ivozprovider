import { Box, Toolbar } from '@mui/material';
import { Header, Menu, Footer } from '@irontec/ivoz-ui/components/layout';
import { RouteMap } from '@irontec/ivoz-ui/router/routeMapParser';

interface AppRouteContentProps {
  routeMap: RouteMap;
  loggedIn: boolean;
  children: JSX.Element;
}

export default function AppRouteContentWrapper(
  props: AppRouteContentProps
): JSX.Element {
  const { loggedIn, routeMap } = props;

  return (
    <>
      <Box sx={{ display: 'flex' }}>
        <Header loggedIn={loggedIn} routeMap={routeMap} />
        <Box sx={{ display: 'flex' }}>
          <Menu routeMap={routeMap} />
        </Box>
        <Box component="main" sx={{ flexGrow: 1, p: 3 }}>
          <Toolbar />
          {props.children}
        </Box>
      </Box>
      <Box>
        <Footer />
      </Box>
    </>
  );
}
