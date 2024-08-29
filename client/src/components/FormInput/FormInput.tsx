import "./FormInput.scss";

interface IFormInputProps {
  label: string;
  type?: React.HTMLInputTypeAttribute;
  id: string;
}

interface IFormSelectInputProps extends IFormInputProps {
  options: string[];
  handleOptionChange: (option: string) => void;
}

export const FormInput = ({ label, type, id }: IFormInputProps) => {
  return (
    <div className="form-input">
      <label htmlFor="">{label}</label>
      <input type={type} id={id} />
    </div>
  );
};

export const FormSelectInput = ({
  label,
  id,
  options,
  handleOptionChange,
}: IFormSelectInputProps) => {
  return (
    <div className="form-input">
      <label>{label}</label>
      <select
        name="type-switch"
        id={id}
        onChange={(e) => handleOptionChange(e.target.value)}
      >
        {options.map((option) => (
          <option value={option} key={option}>
            {option}
          </option>
        ))}
      </select>
    </div>
  );
};
