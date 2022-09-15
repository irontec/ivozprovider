import WhatshotIcon from '@mui/icons-material/Whatshot';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import BannedAddress from '../BannedAddress/BannedAddress';

const BannedAddressBruteForce: EntityInterface = {
  ...BannedAddress,
  icon: WhatshotIcon,
  title: _('Banned IP address', { count: 2 }),
  localPath: '/brute_force',
  columns: ['company', 'aor', 'ip', 'lastTimeBanned', 'description'],
};

export default BannedAddressBruteForce;
