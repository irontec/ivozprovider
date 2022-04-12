import useFkChoices from '@irontec/ivoz-ui/entities/data/useFkChoices';
import defaultEntityBehavior, { EntityFormProps, FieldsetGroups } from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { ExtensionPropertyList } from './ExtensionProperties';
import { foreignKeyGetter } from './foreignKeyGetter';

const Form = (props: EntityFormProps): JSX.Element => {

  const { entityService, row, match } = props;

  const DefaultEntityForm = defaultEntityBehavior.Form;
  const fkChoices: ExtensionPropertyList<any> = useFkChoices({
    foreignKeyGetter,
    entityService,
    row,
    match,
  });

  const groups: Array<FieldsetGroups> = [
    {
      legend: '',
      fields: [
        'number',
      ],
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

  return (
        <DefaultEntityForm
            {...props}
            fkChoices={fkChoices}
            groups={groups}
        />
  );
};

export default Form;