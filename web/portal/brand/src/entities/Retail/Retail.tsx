import Company from '../Company/Company';
import _ from '@irontec/ivoz-ui/services/translations/translate';

const Retail = {
  ...Company,
  title: _('Retail', { count: 2 }),
  localPath: '/retail',
};

export default Retail;
