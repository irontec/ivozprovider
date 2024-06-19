import { Menu } from '@irontec/ivoz-ui/components/layout';
import Loading from '@irontec/ivoz-ui/components/layout/Loading/Loading';
import { StyledCloseIcon } from '@irontec/ivoz-ui/components/shared/Message.styles';
import { RouteMap } from '@irontec/ivoz-ui/router/routeMapParser';
import { Box, IconButton } from '@mui/material';
import MuiAlert from '@mui/material/Alert';
import { useStoreActions, useStoreState } from 'store';

import { Header } from '../Header';

export interface AppRouteContentProps {
  routeMap: RouteMap;
  loggedIn: boolean;
  children: JSX.Element;
  className?: string;
}

export default function AppRouteContentWrapper(
  props: AppRouteContentProps
): JSX.Element {
  const { loggedIn, routeMap, children, className } = props;

  const clearFlassMsg = useStoreActions((actions) => actions.flashMsg.clear);
  const flassMsg = useStoreState((state) => state.flashMsg.msg);
  const flassMsgType = useStoreState((state) => state.flashMsg.type);

  return (
    <div className={className}>
      <Loading />
      <Box className='app-wrapper'>
        <Menu routeMap={routeMap} />
        <Box component='main'>
          <Box component='header' className='breadcrumb'>
            {loggedIn && <Header routeMap={routeMap} />}
          </Box>
          {flassMsg && (
            <div>
              <MuiAlert
                severity={flassMsgType}
                action={
                  <IconButton
                    aria-label='close'
                    color='inherit'
                    onClick={() => {
                      clearFlassMsg();
                    }}
                  >
                    <StyledCloseIcon />
                  </IconButton>
                }
              >
                {flassMsg}
              </MuiAlert>
            </div>
          )}
          <Box component='section'>{children}</Box>
        </Box>
      </Box>
    </div>
  );
}
