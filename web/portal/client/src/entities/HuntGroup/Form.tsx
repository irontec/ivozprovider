import useFkChoices from '@irontec-voip/ivoz-ui/entities/data/useFkChoices';
import {
  EntityFormProps,
  FieldsetGroups,
  Form as DefaultEntityForm,
} from '@irontec-voip/ivoz-ui/entities/DefaultEntityBehavior';
import _ from '@irontec-voip/ivoz-ui/services/translations/translate';

import { foreignKeyGetter } from './ForeignKeyGetter';

const Form = (props: EntityFormProps): JSX.Element => {
  const { entityService, row, match } = props;
  const fkChoices = useFkChoices({
    foreignKeyGetter,
    entityService,
    row,
    match,
  });

  const groups: Array<FieldsetGroups> = [
    {
      legend: _('Basic Configuration'),
      fields: [
        'name',
        'description',
        'preventMissedCalls',
        'allowCallForwards',
        'strategy',
        'ringAllTimeout',
      ],
    },
    {
      legend: _('No answer configuration'),
      fields: [
        'noAnswerLocution',
        'noAnswerTargetType',
        'noAnswerNumberCountry',
        'noAnswerNumberValue',
        'noAnswerExtension',
        'noAnswerVoicemail',
      ],
    },
  ];

  return <DefaultEntityForm {...props} fkChoices={fkChoices} groups={groups} />;
};

export default Form;
