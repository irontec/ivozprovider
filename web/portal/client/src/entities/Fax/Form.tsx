import useFkChoices from '@irontec/ivoz-ui/entities/data/useFkChoices';
import {
  EntityFormProps,
  FieldsetGroups,
  foreignKeyGetter,
  Form as DefaultEntityForm,
} from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import _ from '@irontec/ivoz-ui/services/translations/translate';

import { useStoreState } from '../../store';

const Form = (props: EntityFormProps): JSX.Element => {
  const { entityService, row, match } = props;
  const fkChoices = useFkChoices({
    foreignKeyGetter,
    entityService,
    row,
    match,
  });

  const aboutMe = useStoreState((state) => state.clientSession.aboutMe.profile);

  const groups: Array<FieldsetGroups> = [
    {
      legend: _('Basic configuration'),
      fields: ['name', aboutMe?.vpbx && 'relUserIds'],
    },
    {
      legend: _('Outbound configuration'),
      fields: ['outgoingDdi'],
    },
    {
      legend: _('Inbound configuration'),
      fields: ['sendByEmail', 'email'],
    },
  ];

  return <DefaultEntityForm {...props} fkChoices={fkChoices} groups={groups} />;
};

export default Form;
