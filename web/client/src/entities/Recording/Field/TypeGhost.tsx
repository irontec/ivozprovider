import _ from 'lib/services/translations/translate';

interface LastExecutionProps {
    type: string,
    recorder: string
}

const TypeGhost = (props: LastExecutionProps): JSX.Element => {

    const type = _(props.type);
    const recorder = props.recorder;

    const response = recorder
        ? (<span>{type} ({recorder})</span>)
        : type;

    return (<span>{response}</span>);
}

export default TypeGhost;