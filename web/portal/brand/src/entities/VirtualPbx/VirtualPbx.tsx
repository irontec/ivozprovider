import Company from '../Company/Company';
import _ from '@irontec/ivoz-ui/services/translations/translate';

const VirtualPbx = {
  ...Company,
  title: _('Virtual PBX', { count: 2 }),
  localPath: '/vPbx',
};

export default VirtualPbx;
