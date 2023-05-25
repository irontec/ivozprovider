import _ from '@irontec/ivoz-ui/services/translations/translate';
import CurrencyYenIcon from '@mui/icons-material/CurrencyYen';

import Company from '../Company/Company';

const CompanyBalances = {
  ...Company,
  acl: {
    read: true,
    create: false,
    update: false,
    detail: false,
    delete: false,
    iden: 'Companies',
  },
  icon: CurrencyYenIcon,
  title: _('Prepaid Balance', { count: 2 }),
  localPath: '/prepaid_balance',
  columns: ['typeIcon', 'name', 'billingMethod', 'balance'],
};

export default CompanyBalances;
