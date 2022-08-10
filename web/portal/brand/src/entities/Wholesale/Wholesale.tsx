import Company from '../Company/Company';
import _ from '@irontec/ivoz-ui/services/translations/translate';

const Wholesale = {
  ...Company,
  title: _('Wholesale', { count: 2 }),
  localPath: '/wholesale',
};

export default Wholesale;
