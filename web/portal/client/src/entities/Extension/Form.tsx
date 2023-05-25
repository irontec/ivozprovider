import useFkChoices from '@irontec/ivoz-ui/entities/data/useFkChoices';
import {
  EntityFormProps,
  FieldsetGroups,
  foreignKeyGetter,
  Form as DefaultEntityForm,
} from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';

import { ExtensionPropertyList } from './ExtensionProperties';

const Form = (props: EntityFormProps): JSX.Element => {
  const { entityService, row, match } = props;

  const fkChoices: ExtensionPropertyList<unknown> = useFkChoices({
    foreignKeyGetter,
    entityService,
    row,
    match,
  });

  const groups: Array<FieldsetGroups> = [
    {
      legend: '',
      fields: ['number'],
    },
    {
      legend: '',
      fields: [
        'routeType',
        'ivr',
        'huntGroup',
        'conferenceRoom',
        'user',
        'numberCountry',
        'numberValue',
        'friendValue',
        'queue',
        'conditionalRoute',
        'voicemail',
      ],
    },
  ];

  return <DefaultEntityForm {...props} fkChoices={fkChoices} groups={groups} />;
};

export default Form;
