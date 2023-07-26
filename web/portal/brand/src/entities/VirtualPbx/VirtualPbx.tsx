import _ from '@irontec/ivoz-ui/services/translations/translate';
import ApartmentIcon from '@mui/icons-material/Apartment';

import Company from '../Company/Company';

const VirtualPbx = {
  ...Company,
  icon: ApartmentIcon,
  link: '/doc/en/administration_portal/brand/clients/virtual_pbx.html',
  title: _('Virtual PBX', { count: 2 }),
  localPath: '/vPbx',
};

export default VirtualPbx;
