import _ from '@irontec/ivoz-ui/services/translations/translate';
import CurrencyYenIcon from '@mui/icons-material/CurrencyYen';

import Company from '../Company/Company';
import Actions from './Action';

const CompanyBalances = {
  ...Company,
  path: '/companies/balances',
  acl: {
    read: true,
    create: false,
    update: false,
    detail: false,
    delete: false,
    iden: 'Companies',
  },
  icon: CurrencyYenIcon,
  link: '/doc/${language}/administration_portal/brand/billing/prepaid_balances.html',
  title: _('Prepaid Balance', { count: 2 }),
  localPath: '/prepaid_balance',
  columns: ['typeIcon', 'name', 'billingMethod', 'balance'],
  customActions: Actions,
  defaultOrderBy: '',
};

export default CompanyBalances;
