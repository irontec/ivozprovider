import Company from '../Company/Company';
import ApartmentIcon from '@mui/icons-material/Apartment';
import _ from '@irontec/ivoz-ui/services/translations/translate';

const VirtualPbx = {
  ...Company,
  icon: ApartmentIcon,
  title: _('Virtual PBX', { count: 2 }),
  localPath: '/vPbx',
};

export default VirtualPbx;
