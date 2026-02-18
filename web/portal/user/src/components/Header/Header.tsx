import Breadcrumbs from '@irontec/ivoz-ui/components/layout/Header/Breadcrumbs';
import Settings from '@irontec/ivoz-ui/components/layout/Header/Settings/Settings';
import Logo from '@irontec/ivoz-ui/components/layout/Menu/Logo';
import {
  LightButton,
  SolidButton,
} from '@irontec/ivoz-ui/components/shared/Button/Button.styles';
import { RouteMap } from '@irontec/ivoz-ui/router/routeMapParser';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import CloseRoundedIcon from '@mui/icons-material/CloseRounded';
import MenuIcon from '@mui/icons-material/Menu';
import {
  Box,
  Dialog,
  DialogActions,
  DialogContent,
  MenuItem,
  Typography,
  useMediaQuery,
  useTheme,
} from '@mui/material';
import { useState } from 'react';
import { useStoreActions, useStoreState } from 'store';

import { Avatar } from './Avatar';

export interface headerProps {
  routeMap: RouteMap;
  className?: string;
}

export default function Header(props: headerProps): JSX.Element {
  const { routeMap, className } = props;
  const [open, setOpen] = useState(false);
  const resetAuth = useStoreActions((actions) => actions.auth.resetAll);
  const toggleVisibility = useStoreActions(
    (actions) => actions.menu.toggleVisibility
  );
  const logo = useStoreState((state) => state.theme.logo);
  const version = useStoreState((state) => state.aboutInfo.version);
  const lastUpdated = useStoreState((state) => state.aboutInfo.lastUpdated);
  const commit = useStoreState((state) => state.aboutInfo.commit);

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
            {open && (
              <Dialog
                open={open}
                onClose={() => setOpen(false)}
                aria-labelledby='dialog-about'
                aria-describedby='dialog-about'
              >
                <CloseRoundedIcon
                  className='close-icon'
                  onClick={() => setOpen(false)}
                />
                <DialogContent className='dialog-about'>
                  <img src={logo || './logo.svg'} className='logo' />
                  <p>
                    {_('Version')}: {version} ({commit}) <br />
                    {_('Last update')}: {lastUpdated}
                  </p>
                  <Box
                    sx={{
                      display: 'flex',
                      alignItems: 'center',
                      justifyContent: 'center',
                      gap: 1,
                    }}
                    className='logo'
                  >
                    Powered by <Logo />
                  </Box>
                  <p>©2026 Irontec | All rights reserved</p>
                </DialogContent>
                <DialogActions>
                  <SolidButton
                    onClick={() => setOpen(false)}
                    sx={{ width: '100%' }}
                  >
                    {_('ACCEPT')}
                  </SolidButton>
                </DialogActions>
              </Dialog>
            )}
            <Avatar>
              <MenuItem
                key='about'
                onClick={() => setOpen(true)}
                sx={{ justifyContent: 'center' }}
              >
                <Typography textAlign='center'>{_('About')}</Typography>
              </MenuItem>
              <MenuItem
                key='logout'
                onClick={() => resetAuth()}
                sx={{ justifyContent: 'center' }}
              >
                <Typography textAlign='center'>{_('Logout')}</Typography>
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
