import useFkChoices from '@irontec/ivoz-ui/entities/data/useFkChoices';
import defaultEntityBehavior, {
  EntityFormProps,
  FieldsetGroups,
} from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { foreignKeyGetter } from './ForeignKeyGetter';

const Form = (props: EntityFormProps): JSX.Element => {
  const { entityService, row, match } = props;
  const DefaultEntityForm = defaultEntityBehavior.Form;
  const fkChoices = useFkChoices({
    foreignKeyGetter,
    entityService,
    row,
    match,
  });

  const groups: Array<FieldsetGroups | false> = [
    {
      legend: '',
      fields: ['name', 'description'],
    },
    {
      legend: '',
      fields: [
        {
          name: 'template',
          size: {
            md: 12,
            lg: 12,
            xl: 12,
          },
        },
        {
          name: 'templateHeader',
          size: {
            md: 12,
            lg: 12,
            xl: 12,
          },
        },
        {
          name: 'templateFooter',
          size: {
            md: 12,
            lg: 12,
            xl: 12,
          },
        },
      ],
    },
  ];

  return <DefaultEntityForm {...props} fkChoices={fkChoices} groups={groups} />;
};

export default Form;
