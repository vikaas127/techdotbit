<?php
/**
 * "AI & Python technology stack" section: tabbed categories of the
 * languages, frameworks, LLMs and tools TechDotBit works with.
 * Text badges only (no third-party logos). Extend or change the list with
 * the 'ace_ai_tech_stack' filter.
 */
$ace_stack = apply_filters( 'ace_ai_tech_stack', array(
	'Python & data' => array(
		'intro' => 'Python is the core language of modern AI. We use it end to end, from data preparation to production APIs.',
		'items' => array( 'Python', 'NumPy', 'Pandas', 'Polars', 'SciPy', 'Jupyter', 'Matplotlib', 'Plotly', 'Pydantic', 'SQLAlchemy', 'Celery', 'asyncio' ),
	),
	'Machine learning' => array(
		'intro' => 'Proven frameworks for training, fine-tuning and deploying models.',
		'items' => array( 'PyTorch', 'TensorFlow', 'Keras', 'scikit-learn', 'XGBoost', 'LightGBM', 'JAX', 'Hugging Face Transformers', 'PEFT / LoRA', 'ONNX', 'spaCy', 'NLTK' ),
	),
	'LLMs' => array(
		'intro' => 'We choose the right model for each task, balancing quality, speed, cost and data privacy, including open-source models you can host yourself.',
		'items' => array( 'OpenAI GPT', 'Anthropic Claude', 'Google Gemini', 'Meta Llama', 'Mistral', 'DeepSeek', 'Qwen', 'Cohere', 'Microsoft Phi', 'Embedding models' ),
	),
	'Agents & RAG' => array(
		'intro' => 'Frameworks for retrieval-augmented generation, tool use and multi-agent systems.',
		'items' => array( 'LangChain', 'LangGraph', 'LlamaIndex', 'CrewAI', 'AutoGen', 'Semantic Kernel', 'DSPy', 'Haystack', 'Model Context Protocol (MCP)', 'OpenAI Agents SDK' ),
	),
	'Vector databases' => array(
		'intro' => 'Fast semantic search over your documents and data.',
		'items' => array( 'Pinecone', 'Weaviate', 'Qdrant', 'Milvus', 'Chroma', 'pgvector', 'Elasticsearch', 'OpenSearch', 'Redis Vector', 'FAISS' ),
	),
	'MLOps & data pipelines' => array(
		'intro' => 'Reproducible training, deployment and monitoring.',
		'items' => array( 'MLflow', 'Weights & Biases', 'Kubeflow', 'Airflow', 'Prefect', 'DVC', 'Ray', 'Apache Spark', 'dbt', 'Docker', 'Kubernetes', 'GitHub Actions' ),
	),
	'Serving & APIs' => array(
		'intro' => 'Production APIs and efficient model serving, in the cloud or on your own servers.',
		'items' => array( 'FastAPI', 'Django', 'Flask', 'vLLM', 'Ollama', 'Text Generation Inference', 'NVIDIA Triton', 'BentoML', 'LiteLLM', 'Streamlit', 'Gradio' ),
	),
	'Cloud AI' => array(
		'intro' => 'Managed AI platforms on the major clouds.',
		'items' => array( 'AWS Bedrock', 'Amazon SageMaker', 'Azure OpenAI', 'Azure Machine Learning', 'Google Vertex AI', 'Google Cloud TPU / GPU', 'Databricks', 'Snowflake Cortex' ),
	),
	'Evaluation & safety' => array(
		'intro' => 'Measuring quality and keeping AI safe in production.',
		'items' => array( 'LangSmith', 'Langfuse', 'Ragas', 'Arize Phoenix', 'Promptfoo', 'DeepEval', 'Guardrails AI', 'NeMo Guardrails', 'OpenTelemetry' ),
	),
	'Vision & speech' => array(
		'intro' => 'Computer vision, OCR and voice AI.',
		'items' => array( 'OpenCV', 'YOLO', 'Segment Anything', 'Tesseract OCR', 'Whisper', 'Stable Diffusion', 'MediaPipe', 'Detectron2' ),
	),
) );
if ( ! $ace_stack ) {
	return;
}
$ace_stack_id = 'tdb-stack-' . wp_unique_id();
?>
<section class="lqd-section tdb-stack" aria-labelledby="<?php echo esc_attr( $ace_stack_id ); ?>-title">
	<div class="container">
		<div class="tdb-lp-head">
			<h6 class="ld-fh-element"><?php esc_html_e( 'Technologies', 'ace' ); ?></h6>
			<h2 id="<?php echo esc_attr( $ace_stack_id ); ?>-title"><?php esc_html_e( 'Our AI, Python & LLM technology stack', 'ace' ); ?></h2>
			<p><?php esc_html_e( 'The languages, frameworks, models and tools our engineers use to build reliable AI products.', 'ace' ); ?></p>
		</div>
		<div class="tdb-stack__wrap" data-tdb-tabs>
			<div class="tdb-stack__tabs" role="tablist" aria-label="<?php esc_attr_e( 'Technology categories', 'ace' ); ?>">
				<?php $i = 0; foreach ( $ace_stack as $label => $cat ) : ?>
					<button type="button" role="tab" id="<?php echo esc_attr( "$ace_stack_id-tab-$i" ); ?>" aria-controls="<?php echo esc_attr( "$ace_stack_id-panel-$i" ); ?>" aria-selected="<?php echo 0 === $i ? 'true' : 'false'; ?>"<?php echo 0 === $i ? '' : ' tabindex="-1"'; ?>><?php echo esc_html( $label ); ?></button>
				<?php $i++; endforeach; ?>
			</div>
			<?php $i = 0; foreach ( $ace_stack as $label => $cat ) : ?>
				<div class="tdb-stack__panel" role="tabpanel" id="<?php echo esc_attr( "$ace_stack_id-panel-$i" ); ?>" aria-labelledby="<?php echo esc_attr( "$ace_stack_id-tab-$i" ); ?>"<?php echo 0 === $i ? '' : ' hidden'; ?>>
					<h3 class="tdb-stack__title"><?php echo esc_html( $label ); ?></h3>
					<?php if ( ! empty( $cat['intro'] ) ) : ?><p class="tdb-stack__intro"><?php echo esc_html( $cat['intro'] ); ?></p><?php endif; ?>
					<ul class="tdb-stack__list">
						<?php foreach ( $cat['items'] as $item ) : ?>
							<li><span class="tdb-stack__mono" aria-hidden="true"><?php echo esc_html( mb_strtoupper( mb_substr( $item, 0, 1 ) ) ); ?></span><?php echo esc_html( $item ); ?></li>
						<?php endforeach; ?>
					</ul>
				</div>
			<?php $i++; endforeach; ?>
		</div>
	</div>
</section>
