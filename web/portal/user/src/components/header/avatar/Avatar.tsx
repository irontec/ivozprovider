import ManageAccountsIcon from '@mui/icons-material/ManageAccounts';
import { Avatar } from '@mui/material';
import StyledBadge from './StyledBadge';
import useTerminalStatus from '../useTerminalStatus';

const CustomAvatar = (): JSX.Element => {
  const status = useTerminalStatus();

  return (
    <StyledBadge
      overlap='circular'
      anchorOrigin={{ vertical: 'bottom', horizontal: 'right' }}
      variant='dot'
      color={status.registered ? 'success' : 'error'}
    >
      <Avatar sx={{ bgcolor: 'white', color: 'primary.main' }}>
        <ManageAccountsIcon />
      </Avatar>
    </StyledBadge>
  );
};

export default CustomAvatar;
