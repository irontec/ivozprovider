import { EntityValue } from '@irontec-voip/ivoz-ui';
import defaultEntityBehavior from '@irontec-voip/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface from '@irontec-voip/ivoz-ui/entities/EntityInterface';
import _ from '@irontec-voip/ivoz-ui/services/translations/translate';
import SipIcon from '@mui/icons-material/Sip';

import { DomainProperties, DomainPropertyList } from './DomainProperties';

const properties: DomainProperties = {};

const Domain: EntityInterface = {
  ...defaultEntityBehavior,
  icon: SipIcon,
  iden: 'Domain',
  title: _('SIP domain'),
  path: '/domains',
  toStr: (row: DomainPropertyList<EntityValue>) => row.domain as string,
  properties,
  columns: [],
  selectOptions: async () => {
    const module = await import('./DomainSelectOptions');

    return module.default;
  },
};

export default Domain;
