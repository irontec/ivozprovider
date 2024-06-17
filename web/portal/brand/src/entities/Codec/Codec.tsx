import { EntityValues } from '@irontec-voip/ivoz-ui';
import defaultEntityBehavior from '@irontec-voip/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface from '@irontec-voip/ivoz-ui/entities/EntityInterface';
import _ from '@irontec-voip/ivoz-ui/services/translations/translate';
import AccountTreeIcon from '@mui/icons-material/AccountTree';

import { CodecProperties, CodecPropertyList } from './CodecProperties';

const properties: CodecProperties = {
  type: {
    label: _('Type'),
    enum: {
      audio: _('Audio'),
      video: _('Video'),
    },
  },
  iden: {
    label: _('Iden'),
  },
  name: {
    label: _('Name'),
  },
  id: {
    label: _('Id'),
  },
};

const Codec: EntityInterface = {
  ...defaultEntityBehavior,
  icon: AccountTreeIcon,
  iden: 'Codec',
  title: _('Codec', { count: 2 }),
  path: '/codecs',
  toStr: (row: CodecPropertyList<EntityValues>) => `${row.iden}`,
  properties,
  acl: {
    ...defaultEntityBehavior.acl,
    iden: 'Codecs',
  },
  selectOptions: async () => {
    const module = await import('./SelectOptions');

    return module.default;
  },
};

export default Codec;
