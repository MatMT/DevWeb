import mongoose, { Schema } from "mongoose";

// Objeto y propiedads provenientes de mongoose
const userSchema = new Schema({
    carnet: {
        type: String,
        required: true,
        unique: true,
        lowercase: true,
        trim: true
    },
    nombre: {
        type: String,
        required: true,
        trim: true,
    },
    password: {
        type: String,
        required: true,
        trim: true
    }
})

const model = mongoose.model('Users', userSchema);
export default model;