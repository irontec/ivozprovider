import _ from '@irontec/ivoz-ui/services/translations/translate';
import LogoutIcon from '@mui/icons-material/Logout';
import { ListItemIcon, MenuItem, Typography } from '@mui/material';
import { useStoreActions } from 'store';

import StyledBadge from '../Avatar/StyledBadge';
import useTerminalStatus from '../useTerminalStatus';
import useWebTheme from '../useWebTheme';
import {
  ContainerStatus,
  Logo,
  StatusMenuItem,
  StyledCompanyName,
  StyledHorizontalLine,
} from './MenuItems.styles';

const CustomMenuItems = (): JSX.Element => {
  const resetAuth = useStoreActions((actions) => actions.auth.resetAll);
  const handleLogout = () => {
    resetAuth();
  };

  const status = useTerminalStatus();
  const webTheme = useWebTheme();

  return (
    <>
      <MenuItem key='logout' onClick={handleLogout}>
        <ListItemIcon>
          <LogoutIcon fontSize='small' />
        </ListItemIcon>
        <Typography textAlign='center'>Logout</Typography>
      </MenuItem>
      <StatusMenuItem key='status'>
        <ContainerStatus>
          <Logo style={{ backgroundImage: webTheme.logo }} />
          <p>{status.userName}</p>
          <StyledCompanyName>{status.companyName}</StyledCompanyName>
          <StyledHorizontalLine />
          <p>
            {_('Status Terminal')}:{' '}
            {
              <StyledBadge
                overlap='circular'
                anchorOrigin={{ vertical: 'bottom', horizontal: 'right' }}
                variant='dot'
                style={{ marginLeft: '5px', marginBottom: '2px' }}
                color={status.registered ? 'success' : 'error'}
              ></StyledBadge>
            }
          </p>
          <p>{status.userAgent ? status.userAgent : 'No User Agent'}</p>
          <p>
            {status.ipRegistered ? status.ipRegistered : 'IP Not Registered'}
          </p>
        </ContainerStatus>
      </StatusMenuItem>
    </>
  );
};

export default CustomMenuItems;
