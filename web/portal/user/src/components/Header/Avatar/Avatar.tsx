import Avatar from '@irontec/ivoz-ui/components/layout/Header/Avatar';
import { AvatarProps } from '@irontec/ivoz-ui/components/layout/Header/Avatar/Avatar';

import TerminalStatus from '../MenuItems/MenuItems';
import useTerminalStatus from '../useTerminalStatus';
import StyledBadge from './StyledBadge';

const CustomAvatar = (props: AvatarProps): JSX.Element => {
  const status = useTerminalStatus();
  const { className, children, ...rest } = props;

  return (
    <div className={className}>
      <StyledBadge
        overlap='circular'
        anchorOrigin={{ vertical: 'bottom', horizontal: 'right' }}
        variant='dot'
        color={status.registered ? 'success' : 'error'}
      >
        <Avatar {...rest}>
          {status.gsQRCode && <TerminalStatus status={status} />}
          {children}
        </Avatar>
      </StyledBadge>
    </div>
  );
};

export default CustomAvatar;
