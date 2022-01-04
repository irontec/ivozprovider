import defaultEntityBehavior, { EntityFormProps } from 'lib/entities/DefaultEntityBehavior';
import useFkChoices from './useFkChoices';

const Form = (props: EntityFormProps): JSX.Element => {

    const DefaultEntityForm = defaultEntityBehavior.Form;
    const fkChoices = useFkChoices();

    return (<DefaultEntityForm {...props} fkChoices={fkChoices} />);
}

export default Form;