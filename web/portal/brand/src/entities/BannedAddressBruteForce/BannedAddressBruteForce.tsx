import EntityInterface from '@irontec-voip/ivoz-ui/entities/EntityInterface';
import _ from '@irontec-voip/ivoz-ui/services/translations/translate';
import WhatshotIcon from '@mui/icons-material/Whatshot';

import BannedAddress from '../BannedAddress/BannedAddress';
import Actions from './Action';

const BannedAddressBruteForce: EntityInterface = {
  ...BannedAddress,
  link: '/doc/en/administration_portal/brand/views/bruteforce_attacks.html',
  icon: WhatshotIcon,
  title: _('Brute-force attack', { count: 2 }),
  localPath: '/brute_force',
  columns: ['company', 'aor', 'ip', 'lastTimeBanned', 'description'],
  customActions: Actions,
};

export default BannedAddressBruteForce;
