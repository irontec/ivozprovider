import useFkChoices from '@irontec-voip/ivoz-ui/entities/data/useFkChoices';
import {
  EntityFormProps,
  FieldsetGroups,
  Form as DefaultEntityForm,
} from '@irontec-voip/ivoz-ui/entities/DefaultEntityBehavior';
import _ from '@irontec-voip/ivoz-ui/services/translations/translate';

import { useStoreState } from '../../store';
import { foreignKeyGetter } from './ForeignKeyGetter';

const Form = (props: EntityFormProps): JSX.Element => {
  const { entityService, row, match } = props;

  const fkChoices = useFkChoices({
    foreignKeyGetter,
    entityService,
    row,
    match,
  });

  const aboutMe = useStoreState((state) => state.clientSession.aboutMe.profile);
  const isUserVoicemail = Boolean(row && row?.user !== null);
  const isResidentialVoicemail = Boolean(
    row && row?.residentialDevice !== null
  );
  const isGenericVoicemail = !isUserVoicemail && !isResidentialVoicemail;

  const readOnlyProperties = {
    name: !isGenericVoicemail,
    email: isUserVoicemail,
  };

  const groups: Array<FieldsetGroups> = [
    {
      legend: _('Basic configuration'),
      fields: ['enabled', 'name', isGenericVoicemail && 'relUserIds'],
    },
    {
      legend: _('Notification configuration'),
      fields: ['sendMail', 'email', 'attachSound'],
    },
    {
      legend: _('Customization'),
      fields: [aboutMe?.vpbx && 'locution'],
    },
  ];

  return (
    <DefaultEntityForm
      {...props}
      fkChoices={fkChoices}
      groups={groups}
      readOnlyProperties={readOnlyProperties}
    />
  );
};

export default Form;
