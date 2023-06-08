import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import WhatshotIcon from '@mui/icons-material/Whatshot';

import BannedAddress from '../BannedAddress/BannedAddress';
import Actions from './Action';

const BannedAddressBruteForce: EntityInterface = {
  ...BannedAddress,
  icon: WhatshotIcon,
  title: _('Brute-force attacks', { count: 2 }),
  localPath: '/brute_force',
  columns: ['company', 'aor', 'ip', 'lastTimeBanned', 'description'],
  customActions: Actions,
};

export default BannedAddressBruteForce;
