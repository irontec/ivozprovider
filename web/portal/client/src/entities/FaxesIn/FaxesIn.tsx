import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import OutboundIcon from '@mui/icons-material/Outbound';

import FaxesInOut from '../FaxesInOut/FaxesInOut';

const FaxesIn: EntityInterface = {
  ...FaxesInOut,
  icon: () => {
    return (
      <OutboundIcon
        sx={{
          transform: 'rotate(180deg)',
        }}
      />
    );
  },
  localPath: '/faxes_in',
  acl: {
    ...FaxesInOut.acl,
    create: false,
  },
  title: _('Incoming faxfile', { count: 2 }),
};

export default FaxesIn;
