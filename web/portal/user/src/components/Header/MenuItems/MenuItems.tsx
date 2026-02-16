import _ from '@irontec/ivoz-ui/services/translations/translate';

import { Status } from '../../../store/userStatus/status';
import StyledBadge from '../Avatar/StyledBadge';
import { QrCode } from '../QrCode/QrCode';
import useWebTheme from '../useWebTheme';
import {
  ContainerStatus,
  Logo as LogoWrapper,
  StatusMenuItem,
  StyledCompanyName,
  StyledHorizontalLine,
} from './MenuItems.styles';

const TerminalStatus = (props: { status: Status }): JSX.Element => {
  const { status } = props;
  const webTheme = useWebTheme();

  return (
    <StatusMenuItem key='status'>
      <ContainerStatus>
        {status.gsQRCode ? (
          <QrCode {...status} />
        ) : (
          <LogoWrapper>
            <img src={webTheme.logo} alt='' />
          </LogoWrapper>
        )}

        <p>{status.userName}</p>
        <StyledCompanyName>{status.companyName}</StyledCompanyName>
        <StyledHorizontalLine />
        <p>
          {_('Terminal Status')}:{' '}
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
        <p>{status.ipRegistered ? status.ipRegistered : 'IP Not Registered'}</p>
      </ContainerStatus>
    </StatusMenuItem>
  );
};

export default TerminalStatus;
