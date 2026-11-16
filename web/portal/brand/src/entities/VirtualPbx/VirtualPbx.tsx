import _ from '@irontec/ivoz-ui/services/translations/translate';
import ApartmentIcon from '@mui/icons-material/Apartment';

import ImportUsers from '../Company/Action/ImportUsers';
import Company from '../Company/Company';

const VirtualPbx = {
  ...Company,
  icon: ApartmentIcon,
  link: '/doc/${language}/administration_portal/brand/clients/virtual_pbx.html',
  title: _('Virtual PBX', { count: 2 }),
  localPath: '/vPbx',
  defaultOrderBy: '',
  customActions: {
    ...Company.customActions,
    ImportUsers: {
      action: ImportUsers,
    },
  },
};

export default VirtualPbx;
