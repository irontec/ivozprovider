import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import AccountTreeIcon from '@mui/icons-material/AccountTree';
import selectOptions from './SelectOptions';

const VoiceMail: EntityInterface = {
  ...defaultEntityBehavior,
  icon: AccountTreeIcon,
  iden: 'Voicemail',
  title: _('Voicemail', { count: 2 }),
  path: '/my/company_voicemails',
  acl: {
    ...defaultEntityBehavior.acl,
    iden: 'Voicemail',
  },
  selectOptions,
  toStr: (row: any) => row.name,
};

export default VoiceMail;
