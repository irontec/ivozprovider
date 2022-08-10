import Company from '../Company/Company';
import _ from '@irontec/ivoz-ui/services/translations/translate';

const Residential = {
  ...Company,
  title: _('Residential', { count: 2 }),
  localPath: '/residential',
};

export default Residential;
