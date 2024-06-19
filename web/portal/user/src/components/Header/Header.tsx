import Breadcrumbs from '@irontec/ivoz-ui/components/layout/Header/Breadcrumbs';
import Settings from '@irontec/ivoz-ui/components/layout/Header/Settings/Settings';
import { LightButton } from '@irontec/ivoz-ui/components/shared/Button/Button.styles';
import { RouteMap } from '@irontec/ivoz-ui/router/routeMapParser';
import MenuIcon from '@mui/icons-material/Menu';
import {
  Box,
  MenuItem,
  Typography,
  useMediaQuery,
  useTheme,
} from '@mui/material';
import { useStoreActions } from 'store';

import { Avatar } from './Avatar';

export interface headerProps {
  routeMap: RouteMap;
  className?: string;
}

export default function Header(props: headerProps): JSX.Element {
  const { routeMap, className } = props;
  const resetAuth = useStoreActions((actions) => actions.auth.resetAll);
  const toggleVisibility = useStoreActions(
    (actions) => actions.menu.toggleVisibility
  );
  const handleLogout = () => {
    resetAuth();
  };

  const theme = useTheme();
  const desktop = useMediaQuery(theme.breakpoints.up('md'));

  return (
    <Box className={className}>
      <Box className='start'>
        <Breadcrumbs desktop={desktop} routeMap={routeMap} />
      </Box>

      <Box className='end'>
        {desktop && (
          <>
            <Settings />
            <Avatar>
              <MenuItem key='logout' onClick={handleLogout}>
                <Typography textAlign='center'>Logout</Typography>
              </MenuItem>
            </Avatar>
          </>
        )}

        {!desktop && (
          <LightButton
            onClick={() => {
              toggleVisibility();
            }}
          >
            <MenuIcon />
          </LightButton>
        )}
      </Box>
    </Box>
  );
}
