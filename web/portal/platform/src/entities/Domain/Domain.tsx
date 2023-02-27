import SipIcon from '@mui/icons-material/Sip';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { DomainProperties, DomainPropertyList } from './DomainProperties';
import { EntityValue } from '@irontec/ivoz-ui';

const properties: DomainProperties = {
  domain: {
    label: _('Domain'),
  },
  companyName: {
    label: _('Client'),
  },
  brandName: {
    label: _('Brand'),
  },
};

const Domain: EntityInterface = {
  ...defaultEntityBehavior,
  icon: SipIcon,
  iden: 'Domain',
  title: _('SIP domain', { count: 2 }),
  path: '/domains',
  toStr: (row: DomainPropertyList<EntityValue>) => row.domain as string,
  properties,
  columns: ['domain', 'brandName', 'companyName'],
  acl: {
    read: true,
    detail: false,
    create: false,
    update: false,
    delete: false,
  },
};

export default Domain;
